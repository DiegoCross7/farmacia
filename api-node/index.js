// 1. Importamos librerías
const express = require('express');
const mysql   = require('mysql2/promise');
const cors    = require('cors');

// 2. Creamos la aplicación Express
const app = express();
app.use(cors());           // Permitir peticiones desde tu front en localhost:80
app.use(express.json());   // Para leer JSON en peticiones POST (por si luego amplías)

// 3. Configuramos la conexión a MySQL (igual que en connect.php)
const pool = mysql.createPool({
  host: 'localhost',   // tu servidor MySQL (XAMPP)
  user: 'root',        // tu usuario MySQL
  password: '',        // tu contraseña MySQL (vacía en XAMPP)
  database: 'farmacia' // nombre de tu base de datos
});

// 4. Definimos el endpoint GET /api/productos
app.get('/api/productos', async (req, res) => {
  try {
    // Consulta modificada para incluir el filtro status = 1 como en el PHP original
    const [rows] = await pool.query('SELECT product_id, product_name, product_image, rate, quantity, brand_id, expdate, categories_id, active, status FROM product WHERE status = 1');
    res.json(rows);     // Devolvemos los productos en formato JSON
  } catch (err) {
    console.error('Error en /api/productos:', err);
    res.status(500).json({ error: 'Error al leer productos' });
  }
});

// 5. Arrancamos el servidor en el puerto 3001
const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
  console.log(`API Node escuchando en http://localhost:${PORT}/api/productos`);
});