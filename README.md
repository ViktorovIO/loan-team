## Symfony-Based Application Loan Team

---
### Запуск приложения
1. Выполните команду `make env`
2. `make up-build`
3. `make migrate`

### Эндпоинты API
Добавить клиента `POST: http://localhost:8080/api/client/create`
   - Пример тела запроса:
   ```json
    {
      "lastName": "Doe",
      "firstName": "John",
      "age": 20,
      "ssn": "123-45-6789",
      "ficoScore": 720,
      "email": "john.doe@example.com",
      "phone": "123-456-7890",
      "salary": 1001.00,
      "zip": "12345",
      "state": "NY",
      "city": "New York"
    }
  ```

Обновить клиента `PATCH http://localhost:8080/api/client/1`
  - В запрос на обновление можно подставить любое поле из create
  - Например
  ```json
  {
    "age": 24,
    "salary": 999.00
  }
  ```

Проверка возможности выдачи кредита клиенту `GET http://localhost:8080/api/loan/check/1`
Выдача кредита с предварительной проверкой и последующим уведомлением `GET http://localhost:8080/api/loan/issuance/1`
Уведомление в рамках данного приложения реализовано только для Email, проверить его работу можно по адресу `http://127.0.0.1:1025/#`

Для запуска тестов, выполните команду `make phpunit-tests`