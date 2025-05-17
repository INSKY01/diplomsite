<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Этажи</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Этажи</h1>
        <table>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Множитель</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($floors as $floor)
                <tr>
                    <td>{{ $floor->name }}</td>
                    <td>{{ $floor->multiplier }}</td>
                    <td>
                        <button onclick="openEditModal({{ $floor->id }})">Редактировать</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Модальное окно для редактирования -->
        <div id="editModal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h2>Редактировать этаж</h2>
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="floorId" name="floorId">
                    <div class="form-group">
                        <label for="name">Название:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="multiplier">Множитель:</label>
                        <input type="number" step="0.1" id="multiplier" name="multiplier" required>
                    </div>
                    <div class="form-group">
                        <label for="image">URL изображения:</label>
                        <input type="text" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    <button type="submit">Сохранить</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id) {
            // Загрузка данных этажа по ID через AJAX
            fetch(`/floors/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('floorId').value = data.id;
                    document.getElementById('name').value = data.name;
                    document.getElementById('multiplier').value = data.multiplier;
                    document.getElementById('image').value = data.image;
                    document.getElementById('description').value = data.description;
                    document.getElementById('editModal').style.display = 'block';
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        document.getElementById('editForm').onsubmit = function(event) {
            event.preventDefault();
            const id = document.getElementById('floorId').value;
            const formData = new FormData(this);
            fetch(`/floors/${id}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                closeEditModal();
                location.reload(); // Перезагрузка страницы для обновления данных
            });
        };
    </script>
</body>
</html> 