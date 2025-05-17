<form id="contactForm" action="{{ route('send.feedback') }}" method="POST">
    @csrf
    <div>
        <label for="firstname">Имя:</label>
        <input type="text" id="firstname" name="firstname" required>
    </div>
    <div>
        <label for="tel">Телефон:</label>
        <input type="tel" id="tel" name="tel" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="subject">Сообщение:</label>
        <textarea id="subject" name="subject"></textarea>
    </div>
    <input type="submit" value="Отправить">
</form> 