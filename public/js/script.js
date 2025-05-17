document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();

            
            const formData = {
                id: Date.now(),
                name: document.getElementById('firstname').value,
                phone: document.getElementById('tel').value,
                email: document.getElementById('email').value,
                comment: document.getElementById('subject').value,
                date: new Date().toISOString(),
                status: 'new',
                type: 'contact',
                
                selections: {
                    houseType: '',
                    area: '',
                    floor: '',
                    roof: '',
                    material: '',
                    foundation: '',
                    facade: '',
                    electrical: '',
                    wallFinish: '',
                    additions: []
                },
                totalPrice: 0
            };

            
            let adminData = JSON.parse(localStorage.getItem('adminData') || '{"requests":[]}');
            
            
            adminData.requests.push(formData);
            
            
            localStorage.setItem('adminData', JSON.stringify(adminData));

            
            contactForm.reset();

            
            showNotification('Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.', 'success');
        });
    }

    const toggleButton = document.querySelector('.toggle-button');
    const leftSideContent = document.querySelector('.fourth-section__left-side');

    toggleButton.addEventListener('click', function() {
        leftSideContent.style.display = leftSideContent.style.display === 'block' ? 'none' : 'block';
    });
});


function openModal(src) {
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("modalImage");
    if (modal && modalImg) {
        modal.style.display = "block";
        modalImg.src = src;
        
        
        modal.onclick = function(event) {
            if (event.target === modal) {
                closeModal();
            }
        };

        
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    }
}
function closeModal() {
    const modal = document.getElementById("myModal");
    if (modal) {
        modal.style.display = "none";
    }
}

function showAllImages() {
    const hiddenItems = document.querySelectorAll('.gallery-item.hidden');
    const showAllButton = document.querySelector('.show-all');
    
    hiddenItems.forEach(item => {
        item.classList.remove('hidden');
        
        item.style.animation = 'fadeIn 0.5s ease-out forwards';
    });

    if (showAllButton) {
        showAllButton.style.display = 'none';
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const widthInput = document.getElementById('width');
    const lengthInput = document.getElementById('length');
    
    if (widthInput && lengthInput) {
        widthInput.addEventListener('input', calculateParams);
        lengthInput.addEventListener('input', calculateParams);
    }
});

function calculateParams() {
    const width = parseFloat(document.getElementById('width').value) || 0;
    const length = parseFloat(document.getElementById('length').value) || 0;
    
    const perimeter = 2 * (width + length);
    const area = width * length;
    
    document.getElementById('perimetr_params').innerHTML = 
        `<span>Периметр дома: ${perimeter} м</span>`;
    document.getElementById('area_params').innerHTML = 
        `<span>Площадь дома: ${area} м²</span>`;
}


function selectFoundation(element) {
    
    document.querySelectorAll('.step-row').forEach(row => {
        row.classList.remove('selected');
    });
    
    
    element.classList.add('selected');
}

function showNotification(message, type = 'error') {
    const notification = document.getElementById('notification');
    const notificationMessage = document.getElementById('notificationMessage');
    
    if (notification && notificationMessage) {
        notification.className = `notification ${type}`;
        notificationMessage.textContent = message;
        notification.classList.remove('hidden');
        
        
        setTimeout(() => {
            notification.classList.add('hidden');
        }, 5000);
    }
}

function closeNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.classList.add('hidden');
    }
}

function validateContactForm() {
    const name = document.getElementById('contactName')?.value.trim();
    const phone = document.getElementById('contactPhone')?.value.trim();
    const email = document.getElementById('contactEmail')?.value.trim();

    if (!name || !phone || !email) {
        showNotification('Пожалуйста, заполните все обязательные поля', 'error');
        return false;
    }

    if (!validateEmail(email)) {
        showNotification('Пожалуйста, введите корректный email', 'error');
        return false;
    }

    if (!validatePhone(phone)) {
        showNotification('Пожалуйста, введите корректный номер телефона', 'error');
        return false;
    }

    selections.contact = {
        name,
        phone,
        email,
        comment: document.getElementById('contactComment')?.value.trim() || ''
    };

    return true;
}