// 1. Importamos librerías
const express = require('express');
const { Pool } = require('pg');
const cors = require('cors');

// 2. Creamos la aplicación Express
const app = express();
app.use(cors());
app.use(express.json());

// 3. Configuramos la conexión a PostgreSQL usando variables de entorno
const pool = new Pool({
  host: process.env.PGHOST,
  user: process.env.PGUSER,
  password: process.env.PGPASSWORD,
  database: process.env.PGDATABASE,
  port: process.env.PGPORT
});

// 4. Endpoint para obtener productos
app.get('/api/productos', async (req, res) => {
  try {
    const { rows } = await pool.query('SELECT * FROM product WHERE status = 1');
    res.json(rows);
  } catch (err) {
    console.error('Error en /api/productos:', err);
    res.status(500).json({ error: 'Error al leer productos' });
  }
});

// 5. Arrancamos el servidor
const PORT = process.env.PORT || 3001;
app.listen(PORT, () => {
  console.log(`API Node escuchando en http://localhost:${PORT}/api/productos`);
});
