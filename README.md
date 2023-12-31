# Projeto de API / Backend Laravel

## O projeto consiste no cadastro de cervejas e estilos.
### Estrutura do projeto / observações:
- Registro de usuário.
- Login.
- Autenticação de rotas com sanctum.
- Utilização do Repository Pattern.
- Utlização de Laravel Requests
- Seeds
- Migrations
- Testes de integração
- O token é criado no login
- A comunicação é feita pelo padrão json
- Na função index dos controladores BeerController e BeerStyleController o metodo all() foi substituido pelo metodo paginate(10), afim de evitar sobrecarga no retorno dos dados e possíveis problemas hipotéticos no banco de dados.
- Foi criada uma classe com constantes dos códigos de status http para uso nos retornos dos controllers.

#### Rotas:

- `GET|HEAD        api/auth/beer`
- `POST            api/auth/beer`
- `GET|HEAD        api/auth/beer/{beer}`
- `PUT|PATCH       api/auth/beer/{beer}`
- `DELETE          api/auth/beer/{beer}`
- `POST            api/auth/login (Não protegida pelo middleware auth:sanctum)`
- `POST            api/auth/logout`
- `POST            api/auth/register (Não protegida pelo middleware auth:sanctum)`
- `GET|HEAD        api/auth/style`
- `POST            api/auth/style`
- `GET|HEAD        api/auth/style/{style}`
- `PUT|PATCH       api/auth/style/{style}`
- `DELETE          api/auth/style/{style}`
