<?php
/**
 * SYS CODI7 — API para guardar contenido.json
 * Este archivo recibe el JSON del panel admin y lo guarda en data/contenido.json
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: https://tudominio.com');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token');

// Preflight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'msg' => 'Método no permitido']);
    exit;
}

// ─── AUTENTICACIÓN ───────────────────────────────────────────
// Cambia esta clave en producción. Debe coincidir con la variable
// ADMIN_SECRET en admin/index.html
define('ADMIN_SECRET', 'SYSCODI7_BjdGmIXL0tKQMBzu');

$token = $_SERVER['HTTP_X_AUTH_TOKEN'] ?? '';
if ($token !== ADMIN_SECRET) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'msg' => 'No autorizado']);
    exit;
}

// ─── RECIBIR BODY ────────────────────────────────────────────
$raw = file_get_contents('php://input');
if (empty($raw)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'msg' => 'Body vacío']);
    exit;
}

// Validar JSON
$data = json_decode($raw, true);
if ($data === null) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'msg' => 'JSON inválido: ' . json_last_error_msg()]);
    exit;
}

// ─── GUARDAR ARCHIVO ─────────────────────────────────────────
$ruta = __DIR__ . '/../data/contenido.json';

// Backup automático (guarda la versión anterior)
if (file_exists($ruta)) {
    $backup = __DIR__ . '/../data/contenido_backup.json';
    copy($ruta, $backup);
}

$ok = file_put_contents(
    $ruta,
    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
);

if ($ok === false) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'msg' => 'Error al escribir el archivo. Verifica permisos de la carpeta data/']);
    exit;
}

echo json_encode(['ok' => true, 'msg' => 'Contenido guardado correctamente', 'bytes' => $ok]);
