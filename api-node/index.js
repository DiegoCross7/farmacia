// 1. Importamos librerías
const express = require('express');
const mysql   = require('mysql2/promise');
const cors    = require('cors');

// 2. Creamos la aplicación Express
const app = express();
app.use(cors());
app.use(express.json());

// 3. Configuramos la conexión a MySQL usando vars de entorno
const pool = mysql.createPool({
  host:     process.env.DB_HOST,
  user:     process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME,
  port:     process.env.DB_PORT ? parseInt(process.env.DB_PORT) : 3306,
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

// 4. Definimos el endpoint GET /api/productos
app.get('/api/productos', async (req, res) => {
  try {
    const [rows] = await pool.query(
      'SELECT product_id, product_name, product_image, rate, quantity, brand_id, expdate, categories_id, active, status FROM product WHERE status = 1'
    );
    res.json(rows);
  } catch (err) {
    console.error('Error en /api/productos:', err);
    res.status(500).json({ error: 'Error al leer productos' });
  }
});

// 5. Arrancamos el servidor en el puerto que asigne Render
const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
  console.log(`API Node escuchando en http://localhost:${PORT}/api/productos`);
});
