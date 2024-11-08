import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';

const app = express();
const PORT = 64545;

// Obtenez le chemin du répertoire courant
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Servir les fichiers statiques
app.use(express.static(path.join(__dirname, 'doc')));

// Définir la route principale pour servir le fichier HTML
app.get('/apidoc', (req, res) => {
  res.sendFile(path.join(__dirname, 'doc/index.html'));
});

// Démarrer le serveur
app.listen(PORT, () => {
  console.log(`Serveur ouvert sur le port ${PORT}`);
});
