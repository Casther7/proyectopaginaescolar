<?php
require_once __DIR__ . '/../../../model/MensajeModel.php';

$rutaActual = (isset($_GET['ruta']) && $_GET['ruta'] === 'panel-usuario') ? 'panel-usuario' : 'admin';
$accionMensajes = 'index.php?ruta=' . $rutaActual . '&vista=mensajes';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion_mensaje'])) {
    $accion = $_POST['accion_mensaje'];
    $idMensaje = (int)($_POST['mensaje_id'] ?? 0);

    if ($idMensaje > 0) {
        if ($accion === 'leer') {
            $resultado = MensajeModel::mdlMarcarLeido($idMensaje);
            $_SESSION['mensajesMensaje'] = ($resultado === 'ok') ? 'leer_ok' : 'leer_error';
        }
        if ($accion === 'eliminar') {
            $resultado = MensajeModel::mdlEliminarMensaje($idMensaje);
            $_SESSION['mensajesMensaje'] = ($resultado === 'ok') ? 'eliminar_ok' : 'eliminar_error';
        }
    } else {
        $_SESSION['mensajesMensaje'] = 'accion_invalida';
    }
}

$mensajeEstado = $_SESSION['mensajesMensaje'] ?? null;
unset($_SESSION['mensajesMensaje']);

$mensajes = MensajeModel::mdlListarMensajes();

// Respaldo: si por alguna razon el modelo no devuelve filas,
// consultamos directamente la tabla para no dejar la bandeja vacia.
if (empty($mensajes)) {
    try {
        require_once __DIR__ . '/../../../config/conexion.php';
        $stmtFallback = Conexion::conectar()->prepare("SELECT * FROM mensajes ORDER BY id DESC LIMIT 200");
        $stmtFallback->execute();
        $rowsFallback = $stmtFallback->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($rowsFallback)) {
            $mensajes = array_map(function($r) {
                return [
                    'id' => $r['id'] ?? 0,
                    'nombre' => $r['nombre'] ?? '',
                    'email' => $r['email'] ?? '',
                    'telefono' => $r['telefono'] ?? '',
                    'asunto' => $r['asunto'] ?? '',
                    'mensaje' => $r['mensaje'] ?? '',
                    'fecha_envio' => $r['fecha_envio'] ?? date('Y-m-d H:i:s'),
                    'estado' => $r['estado'] ?? 'no_leido',
                ];
            }, $rowsFallback);
        }
    } catch (Throwable $e) {
        error_log('admin_mensajes.php fallback ERROR: ' . $e->getMessage());
    }
}
?>

<div id="vista-mensajes" class="dashboard-content" style="display: none;">

    <div class="header-mensajes">
        <div>
            <h1 class="page-title">✉️ Bandeja de Entrada</h1>
            <p>Mensajes recibidos desde el formulario de contacto publico.</p>
        </div>
    </div>

    <?php if ($mensajeEstado === 'leer_ok'): ?>
        <div class="alert alert-success">Mensaje marcado como leido correctamente.</div>
    <?php elseif ($mensajeEstado === 'leer_error'): ?>
        <div class="alert alert-danger">No se pudo marcar el mensaje como leido.</div>
    <?php elseif ($mensajeEstado === 'eliminar_ok'): ?>
        <div class="alert alert-success">Mensaje eliminado correctamente.</div>
    <?php elseif ($mensajeEstado === 'eliminar_error'): ?>
        <div class="alert alert-danger">No se pudo eliminar el mensaje.</div>
    <?php elseif ($mensajeEstado === 'accion_invalida'): ?>
        <div class="alert alert-warning">La accion solicitada no es valida.</div>
    <?php endif; ?>

    <div class="card card-tabla">
        <table class="tabla-mensajes">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Remitente</th>
                    <th>Telefono</th>
                    <th>Interes</th>
                    <th>Mensaje</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mensajes)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;padding:30px;color:#64748b;">No hay mensajes todavia.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($mensajes as $m): ?>
                    <?php
                        $filaClase = ($m['estado'] === 'no_leido') ? 'fila-nueva' : 'fila-leida';
                        $timestamp = strtotime((string)($m['fecha_envio'] ?? ''));
                        $fecha = $timestamp ? date('d/m/Y h:i A', $timestamp) : date('d/m/Y h:i A');
                        $mensajeTexto = (string)($m['mensaje'] ?? '');
                        if (function_exists('mb_strimwidth')) {
                            $msgTruncado = mb_strimwidth($mensajeTexto, 0, 75, '...');
                        } else {
                            $msgTruncado = (strlen($mensajeTexto) > 75)
                                ? substr($mensajeTexto, 0, 72) . '...'
                                : $mensajeTexto;
                        }
                    ?>
                    <tr class="<?php echo $filaClase; ?>">
                        <td class="fecha-msj"><?php echo htmlspecialchars($fecha); ?></td>
                        <td>
                            <div class="remitente-nombre"><?php echo htmlspecialchars($m['nombre']); ?></div>
                            <div class="remitente-email"><?php echo htmlspecialchars($m['email']); ?></div>
                        </td>
                        <td><?php echo htmlspecialchars((string)($m['telefono'] ?? '')); ?></td>
                        <td class="tag-interes"><?php echo htmlspecialchars($m['asunto']); ?></td>
                        <td class="mensaje-truncado" title="<?php echo htmlspecialchars($m['mensaje']); ?>"><?php echo htmlspecialchars($msgTruncado); ?></td>
                        <td class="text-center" style="display:flex;gap:8px;justify-content:center;">
                            <form method="POST" action="<?php echo htmlspecialchars($accionMensajes); ?>" style="display:inline;">
                                <input type="hidden" name="accion_mensaje" value="leer">
                                <input type="hidden" name="mensaje_id" value="<?php echo (int)$m['id']; ?>">
                                <button type="submit" class="btn-leer-sec">Marcar leido</button>
                            </form>
                            <form method="POST" action="<?php echo htmlspecialchars($accionMensajes); ?>" style="display:inline;" onsubmit="return confirm('¿Eliminar mensaje?');">
                                <input type="hidden" name="accion_mensaje" value="eliminar">
                                <input type="hidden" name="mensaje_id" value="<?php echo (int)$m['id']; ?>">
                                <button type="submit" class="btn-eliminar" title="Eliminar">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>