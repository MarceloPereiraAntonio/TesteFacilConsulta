# 📌 API de Gestão de Consultas Médicas

## 📌 Introdução
Esta API foi desenvolvida para gerenciar **médicos, pacientes e consultas**. Os usuários podem cadastrar médicos e pacientes, agendar consultas e listar informações de forma organizada. Apenas **usuários autenticados** podem acessar os recursos protegidos.

---

## 🛠 Requisitos para instalar o projeto
Você vai precisa instalar o docker, e caso ainda não tenha siga o passo a passo no site https://docs.docker.com/engine/install/

---

## 🔧 Configuração do Projeto
1. Clone o repositório:
   ```sh
   https://github.com/MarceloPereiraAntonio/TesteFacilConsulta.git
   cd seu-repositorio
   ```
2. Configure o arquivo **.env**:
   ```sh
   cp .env.example .env
   ```
   - Configure as variáveis de banco de dados (`DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
3. Rode o seguinte comando:
   ```sh
   ./vendor/bin/sail up -d
   - Isso vai iniciar a instalação de todas as dependências para o projeto funcionar. 
   ```
4. Para facilitar os comandos do **Laravel Sail** rode o seguinte comando.
    ```sh
    alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)' 
    ```
5. Após a instalação do projeto e com todos os containers em operação rode as **migrations e seeders**:
   ```sh
   sail artisan migrate --seed
   - O comando acima irá popular a base de dados.
   ```

---

## 🔐 Autenticação
A API usa **JWT (JSON Web Token)** para autenticação.
Após ter rodado as **migrations e seeders** você terá a seu dispor um usuário de teste que será ultilizado para obter seu **token JWT**
Esses são os dados do seu usuário:
```json
{
    "name": "Test User",
    "email": "test@teste.com",
    "password": "password"
}
```

### **1 Login do usuário**
```http
POST /api/login
```
#### 📌 Corpo da requisição:
```json
{
   "email": "test@teste.com",
    "password": "password"
}
```
✅ **Retorna o token JWT:**
```json
{
     "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "bearer",
    "expires_in": 3600
}
```

---

## 🌍 Rotas publicas Disponíveis
> Todas as requisições **DEVEM** incluir o token JWT no header:
> ```
> Authorization: Bearer {TOKEN_JWT}
> ```
### 📌 **Cidades**

#### 1️⃣ **Listar**
```http
GET /api/cidades
```
📌 **Parâmetro opcional:** `nome` → Filtra pelo nome.

### 📌 **Médicos**

#### 2 **Listar médicos**
```http
GET /api/medicos
```
📌 **Parâmetro opcional:** `nome` → Filtra pelo nome (ignora "Dr." e "Dra.")

#### 3 **Listar médicos por cidade**
```http
GET /api/cidades/{id_cidade}/medicos
```
## 🔒 Rotas privadas Disponíveis
> Todas as requisições **DEVEM** incluir o token JWT no header:
> ```
> Authorization: Bearer {TOKEN_JWT}
> ```

## 📌 **Médicos**

#### 2 **Adicionar novo médico**
```http
POST /api/medicos
```
📌 **Corpo da requisição:**
```json
{
    "medico_id": 1,
    "paciente_id": 3,
    "data": "2025-02-15 14:00:00"
}
```
#### 2 **Agendar consulta**
```http
POST /api/medicos/consulta
```
📌 **Corpo da requisição:**
```json
{
    "medico_id": 1,
    "paciente_id": 3,
    "data": "2025-02-15 14:00:00"
}
```

---

### 📌 **Pacientes**

#### 3 **Listar pacientes do médico**
```http
GET /api/medicos/{id_medico}/pacientes
```
📌 **Parâmetros opcionais:**
- `apenas-agendadas=true` → Retorna apenas consultas futuras.
- `nome=Maria` → Filtra pelo nome do paciente.
✅ **Retorno esperado:**
```json
{
    "data": [
        {
            "medico_id": 19,
            "data_consulta": "2025-02-19 07:52:45",
            "id": 14,
            "nome": "Miss Shyanne Wilderman DDS",
            "cpf": "602.974.637-16",
            "celular": "1-224-561-3932"
        }
    ],
}
```
#### 4 **Adicionar novo paciente**
```http
POST /api/pacientes/
```
📌 **Corpo da requisição:**
```json
{
    "nome": "Mario",
    "cpf": "48704355889",
    "celular": "11984325789"
}
```
---
#### 5 **Atualizar paciente**
```http
POST /api/pacientes/{id_paciente}
```
📌 **Corpo da requisição:**
```json
{
    "nome": "Carlos Mendes",
    "celular": "11987654321"
}
```
---

### 📌 **Consultas**

#### 6 **Agendar uma nova consulta**
```http
POST /api/medicos/consulta
```
📌 **Corpo da requisição:**
```json
{
    "medico_id": 1,
    "paciente_id": 3,
    "data": "2025-02-15 14:00:00"
}
```
✅ **Retorno esperado:**
```json
{
    "medico_id": 18,
    "paciente_id": 12,
    "data": "2025-02-05 12:19:58",
    "updated_at": "2025-02-01T19:07:17.000000Z",
    "created_at": "2025-02-01T19:07:17.000000Z",
    "id": 19
}
```

---

## 🚀 Conclusão
Essa API fornece **gestão completa** de médicos, pacientes e consultas, permitindo operações seguras e eficientes. **Somente usuários autenticados** podem acessar os recursos protegidos.

✅ **Principais funcionalidades:**
- Autenticação JWT 🔐
- CRUD de médicos e pacientes 📋
- Agendamento de consultas 📆
- Filtros avançados 🔎

---

