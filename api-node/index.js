// 1. Importamos las librerías necesarias
const express = require('express');
const cors = require('cors');
const { Pool } = require('pg');

// 2. Creamos la aplicación Express
const app = express();
app.use(cors());           // Permitir peticiones desde tu front en localhost:80
app.use(express.json());   // Para leer JSON en peticiones POST

// 3. Configuramos la conexión a PostgreSQL
const pool = new Pool({
  host: 'dpg-d0hmad6uk2gs73eo7ql0-a.oregon-postgres.render.com',
  user: 'farmacia_jt4w_user',
  password: 'NnGIhKth5cHa9cdQS6BQB69iGHVrAFL6',
  database: 'farmacia_jt4w',
  port: 5432,
  ssl: {
    rejectUnauthorized: false
  }
});

// 4. Definimos el endpoint GET /api/productos
app.get('/api/productos', async (req, res) => {
  try {
    const query = `
      SELECT product_id, product_name, product_image, rate, quantity, brand_id, expdate, categories_id, active, status
      FROM product
      WHERE status = 1
    `;
    const { rows } = await pool.query(query);
    res.json(rows);
  } catch (err) {
    console.error('Error en /api/productos:', err);
    res.status(500).json({ error: 'Error al leer productos' });
  }
});

// 5. Ruta raíz para evitar el error "Cannot GET /"
app.get('/', (req, res) => {
  res.send('Bienvenido a la API de Farmacia');
});

// 6. Arrancamos el servidor en el puerto 3001
const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
  console.log(`API Node escuchando en http://localhost:${PORT}/api/productos`);
});
