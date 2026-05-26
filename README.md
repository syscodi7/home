# SYS CODI7 — Guía de publicación en hosting

## Estructura de archivos

```
syscodi7/
├── index.html          ← Sitio público (no editar)
├── robots.txt          ← SEO: instrucciones para Google
├── sitemap.xml         ← SEO: mapa del sitio
├── .htaccess           ← Configuración Apache (cPanel)
├── data/
│   └── contenido.json  ← ⭐ AQUÍ SE EDITA TODO EL CONTENIDO
├── assets/
│   └── img/
│       └── favicon.svg ← Ícono de la pestaña del navegador
└── admin/
    ├── index.html      ← Panel de administración
    └── guardar.php     ← API para guardar cambios en el servidor
```

---

## Cómo publicar en hosting (cPanel / Hostinger / SiteGround)

### Primera vez
1. Sube **todos los archivos** a la carpeta `public_html/` (o la raíz de tu dominio)
2. Asegúrate de que la carpeta `data/` tenga permisos **755** y el archivo `contenido.json` tenga **644**
3. Abre tu dominio y verifica que el sitio carga correctamente
4. Entra al panel de admin en: `https://tu-dominio.com/admin/`
   - Usuario: `admin`
   - Contraseña: `iz0p6mr7vT0E`

### Actualizar contenido (después de publicado)
1. Entra a `https://tu-dominio.com/admin/`
2. Edita lo que necesites (servicios, portafolio, textos, contacto, etc.)
3. Haz clic en **Guardar cambios**
4. Si PHP funciona → el sitio se actualiza **al instante** ✓
5. Si no → se descarga `contenido.json` y lo subes manualmente a `data/`

---

## Cambiar contraseña del admin

**Contraseña del panel (localStorage del navegador):**
Ve a Admin → Seguridad → cambia usuario y contraseña

**Token de la API PHP (más seguro):**
Edita `admin/guardar.php` línea `define('ADMIN_SECRET', '...')` y el mismo valor en `admin/index.html` en `const ADMIN_SECRET = '...'`

---

## Compatibilidad

| Tipo de hosting     | Guardado automático | Funciona |
|---------------------|---------------------|---------|
| cPanel con PHP      | ✅ Sí, instantáneo  | ✅ Sí  |
| Hostinger (PHP)     | ✅ Sí, instantáneo  | ✅ Sí  |
| SiteGround (PHP)    | ✅ Sí, instantáneo  | ✅ Sí  |
| Netlify (estático)  | ⬇ Descarga el JSON  | ✅ Sí  |
| Vercel (estático)   | ⬇ Descarga el JSON  | ✅ Sí  |
| GitHub Pages        | ⬇ Descarga el JSON  | ✅ Sí  |
| XAMPP / local       | ✅ Sí, instantáneo  | ✅ Sí  |

---

## Permisos de carpetas (cPanel → Administrador de archivos)

```
public_html/          → 755
public_html/data/     → 755  ← importante para que PHP pueda escribir
public_html/admin/    → 755
contenido.json        → 644
```

---

## Agregar imágenes al portafolio

Para las imágenes de proyectos puedes usar:
- **URL de imagen** de tu propio hosting: `https://tu-dominio.com/assets/img/proyecto1.jpg`
- **URL externa**: Imgur, Cloudinary, Google Drive (enlace directo)
- **Unsplash**: `https://images.unsplash.com/photo-ID?w=800&q=75`

---

*Desarrollado por SYS CODI7 — syscodi7@gmail.com*


## Seguridad mejorada
- Nueva clave secreta configurada
- Contraseña de administrador actualizada
- CORS restringido
- Protección HTTPS agregada
- Bloqueo de backups JSON

### Credenciales nuevas
- Usuario: admin
- Contraseña: iz0p6mr7vT0E
