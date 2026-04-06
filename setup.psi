# setup.ps1

Write-Host "Configurando certificados SSL para PHP..." -ForegroundColor Yellow

# Cria a pasta
New-Item -ItemType Directory -Force -Path "C:\php\ssl" | Out-Null

# Baixa o certificado
Invoke-WebRequest -Uri "https://curl.se/ca/cacert.pem" -OutFile "C:\php\ssl\cacert.pem"

# Detecta o php.ini automaticamente
$phpIni = php -r "echo php_ini_loaded_file();"

# Adiciona as linhas se ainda não existirem
$content = Get-Content $phpIni -Raw

if ($content -notmatch "curl.cainfo") {
    Add-Content $phpIni "`ncurl.cainfo = `"C:\php\ssl\cacert.pem`""
}

if ($content -notmatch "openssl.cafile") {
    Add-Content $phpIni "`nopenssl.cafile = `"C:\php\ssl\cacert.pem`""
}

Write-Host "Concluido! Reinicie o servidor." -ForegroundColor Green