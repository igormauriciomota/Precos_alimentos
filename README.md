# Monitor de Preços — Projeto Completo

Projeto completo para monitoramento de preços da cesta básica.
Inclui frontend (HTML/CSS/JS), backend (PHP PDO), banco MySQL (schema + dados),
scripts de exportação, e instruções de deploy na Hostinger.


## Como usar

1. Crie banco MySQL na Hostinger (hPanel) ou local:
   - Nome: monitor_precos
   - Usuário: monitor_user
   - Senha: sua_senha

2. Importe o arquivo `sql/monitor_precos.sql` via phpMyAdmin.

3. Edite `.env.example` com suas credenciais e renomeie para `.env`.
   Coloque o arquivo `.env` no diretório raiz do projeto (mesmo nível de backend/ e public_html/).
   Em hosting, você pode colocar as variáveis de ambiente no painel.

4. Envie o conteúdo de `public_html/` para o `public_html` no Hostinger.
   Envie a pasta `backend/` e `sql/` para fora do `public_html` idealmente.
   Ajuste o include de config em `public_html` se necessário.

5. Acesse `https://seusite.com/index.php`.

## Notas
- As páginas usam CDN para Bootstrap, Chart.js, html2canvas e jsPDF.
- Exportação Excel gera CSV com `export-excel.php`.
- Proteja o arquivo `.env` e `backend/config.php`.

