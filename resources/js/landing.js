/**
 * Landing Page JavaScript
 * Funciones principales para la interacción de la página
 */

// Función para alternar el menú móvil
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    if (menu) {
        menu.classList.toggle('hidden');
    }
}

// Función para cerrar el menú móvil al hacer scroll
function setupScrollMenuClose() {
    window.addEventListener('scroll', function() {
        const menu = document.getElementById('mobileMenu');
        if (menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
        }
    });
}

// Función para cerrar el menú al hacer clic en un enlace
function setupMenuLinkClose() {
    const menuLinks = document.querySelectorAll('#mobileMenu a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            if (menu) {
                menu.classList.add('hidden');
            }
        });
    });
}

// Función para scroll suave a las secciones
function setupSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Función para animaciones al hacer scroll
function setupScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observar elementos que queremos animar
    const animateElements = document.querySelectorAll('.transform');
    animateElements.forEach(el => observer.observe(el));
}

// Función para lazy loading de imágenes
function setupLazyLoading() {
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const image = entry.target;
                    image.classList.add('loaded');
                    observer.unobserve(image);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }
}

// Función para el efecto parallax suave
function setupParallax() {
    const parallaxElements = document.querySelectorAll('.parallax');
    
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset;
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            const yPos = -(scrollTop * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    });
}

// Función para validación del formulario
function setupFormValidation() {
    const form = document.querySelector('form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const email = form.querySelector('input[type="email"]');
            const nombre = form.querySelector('input[name="nombre"]');
            const mensaje = form.querySelector('textarea[name="mensaje"]');
            
            let isValid = true;
            
            // Validar email
            if (email && !isValidEmail(email.value)) {
                showFieldError(email, 'Por favor, introduce un email válido');
                isValid = false;
            } else {
                clearFieldError(email);
            }
            
            // Validar nombre
            if (nombre && nombre.value.trim().length < 2) {
                showFieldError(nombre, 'El nombre debe tener al menos 2 caracteres');
                isValid = false;
            } else {
                clearFieldError(nombre);
            }
            
            // Validar mensaje
            if (mensaje && mensaje.value.trim().length < 10) {
                showFieldError(mensaje, 'El mensaje debe tener al menos 10 caracteres');
                isValid = false;
            } else {
                clearFieldError(mensaje);
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }
}

// Función auxiliar para validar email
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Función auxiliar para mostrar errores en campos
function showFieldError(field, message) {
    clearFieldError(field);
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error text-red-500 text-sm mt-1';
    errorDiv.textContent = message;
    
    field.parentNode.appendChild(errorDiv);
    field.classList.add('border-red-500');
}

// Función auxiliar para limpiar errores en campos
function clearFieldError(field) {
    if (field) {
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
        field.classList.remove('border-red-500');
    }
}

// Función para mejorar accesibilidad del teclado
function setupKeyboardNavigation() {
    // Permitir cerrar el menú móvil con Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const menu = document.getElementById('mobileMenu');
            if (menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        }
    });
}

// Función para analytics y tracking
function setupAnalytics() {
    // Tracking de clics en botones importantes
    const trackingButtons = document.querySelectorAll('a[href="#contacto"], .whatsapp-float');
    
    trackingButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Aquí puedes añadir tu código de analytics
            console.log('Button clicked:', this.textContent || this.title);
        });
    });
}

// Función principal de inicialización
function initLandingPage() {
    // Esperar a que el DOM esté completamente cargado
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
}

// Función de inicialización interna
function init() {
    setupScrollMenuClose();
    setupMenuLinkClose();
    setupSmoothScroll();
    setupScrollAnimations();
    setupLazyLoading();
    setupParallax();
    setupFormValidation();
    setupKeyboardNavigation();
    setupAnalytics();
    
    console.log('Landing page initialized successfully');
}

// Inicializar la página
initLandingPage();

// Exportar funciones globales para uso en HTML
window.toggleMobileMenu = toggleMobileMenu;
