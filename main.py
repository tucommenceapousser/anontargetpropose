import http.server
import socketserver

# Spécifiez le port sur lequel vous souhaitez exécuter le serveur
PORT = 8000

# Créez un gestionnaire de requêtes HTTP
Handler = http.server.SimpleHTTPRequestHandler

# Utilisez le gestionnaire de serveurs pour démarrer le serveur web
with socketserver.TCPServer(("0.0.0.0", PORT), Handler) as httpd:
    print("Serveur démarré sur le port", PORT)
    # Écoutez les requêtes HTTP indéfiniment
    httpd.serve_forever()
