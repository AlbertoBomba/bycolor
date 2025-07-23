// Tailwind Landing Page JavaScript Functions

// Alpine.js Contact Form Component
function contactForm() {
    return {
        loading: false,
        message: '',
        messageType: '',
        errors: {},
        formData: {
            nombre: '',
            telefono: '',
            email: '',
            paquete: '',
            mensaje: ''
        },
        
        init() {
            // Marcar que Alpine.js está manejando el formulario
            window.alpineFormActive = true;
            console.log('ContactForm inicializado con Alpine.js, loading:', this.loading);
            console.log('Mensaje inicial:', this.message);
            console.log('MessageType inicial:', this.messageType);
        },
        
        async submitForm() {
            console.log('submitForm llamado, loading antes:', this.loading);
            
            // Prevenir envíos múltiples con flag global
            if (this.loading || window.formSubmitting) {
                console.log('Ya está enviando, ignorando...');
                return;
            }
            
            // Establecer flag global
            window.formSubmitting = true;
            this.loading = true;
            this.message = '';
            this.errors = {};
            
            console.log('Estado loading establecido a true:', this.loading);
            
            try {
                // Verificar que tenemos el token CSRF
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    throw new Error('Token CSRF no encontrado');
                }
                
                const formData = new FormData();
                formData.append('_token', csrfToken.getAttribute('content'));
                formData.append('nombre', this.formData.nombre);
                formData.append('telefono', this.formData.telefono);
                formData.append('email', this.formData.email);
                formData.append('paquete', this.formData.paquete);
                formData.append('mensaje', this.formData.mensaje);
                
                console.log('Enviando formulario...');
                
                // Get the route URL from a global variable that will be set in the Blade template
                const contactUrl = window.contactRoute || '/contacto';
                
                const response = await fetch(contactUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                });
                
                console.log('Respuesta recibida:', response.status);
                
                // Intentar parsear la respuesta como JSON
                let data;
                try {
                    const responseText = await response.text();
                    console.log('Texto de respuesta:', responseText);
                    data = JSON.parse(responseText);
                } catch (parseError) {
                    console.error('Error parseando JSON:', parseError);
                    throw new Error('Respuesta del servidor no válida');
                }
                
                console.log('Datos parseados:', data);
                
                if (response.ok && data.success) {
                    this.message = data.message || '¡Mensaje enviado correctamente! Te contactaremos pronto.';
                    this.messageType = 'success';
                    this.errors = {}; // Limpiar errores
                    
                    console.log('Éxito - mensaje establecido:', this.message);
                    console.log('Tipo de mensaje:', this.messageType);
                    
                    // Limpiar formulario
                    this.formData = {
                        nombre: '',
                        telefono: '',
                        email: '',
                        paquete: '',
                        mensaje: ''
                    };
                    
                    // Scroll suave al mensaje después de un breve delay
                    setTimeout(() => {
                        const messageEl = document.querySelector('[x-show="message && message.length > 0"]');
                        if (messageEl && messageEl.style.display !== 'none') {
                            messageEl.scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'center' 
                            });
                        }
                    }, 200);
                    
                } else {
                    if (data.errors) {
                        this.errors = data.errors;
                        this.message = 'Por favor, corrige los errores en el formulario.';
                        console.log('Errores de validación:', data.errors);
                    } else {
                        this.message = data.message || 'Hubo un error al enviar el mensaje. Inténtalo de nuevo.';
                    }
                    this.messageType = 'error';
                    console.log('Error - mensaje establecido:', this.message);
                }
                
            } catch (error) {
                console.error('Error completo:', error);
                this.message = 'Error de conexión. Por favor, inténtalo de nuevo.';
                this.messageType = 'error';
            } finally {
                // Limpiar flags
                this.loading = false;
                window.formSubmitting = false;
                console.log('Estado loading restablecido a false:', this.loading);
                console.log('Mensaje final:', this.message);
                console.log('MessageType final:', this.messageType);
                
                // Auto-ocultar mensaje después de 8 segundos si es éxito
                if (this.messageType === 'success' && this.message) {
                    setTimeout(() => {
                        console.log('Auto-ocultando mensaje de éxito');
                        this.message = '';
                        this.messageType = '';
                    }, 8000);
                }
            }
        }
    }
}

// Función para el menú móvil
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}

// Backup JavaScript vanilla para el formulario (solo si Alpine.js no está disponible)
document.addEventListener('DOMContentLoaded', function() {
    // Esperar un poco para que Alpine.js se inicialice
    setTimeout(() => {
        // Verificar si Alpine.js está manejando el formulario
        if (window.alpineFormActive || typeof window.Alpine !== 'undefined') {
            console.log('Alpine.js detectado y activo, usando Alpine.js para el formulario');
            return;
        }
        
        console.log('Alpine.js no detectado, usando JavaScript vanilla como respaldo');
        
        const form = document.getElementById('contactoForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const loadingText = document.getElementById('loadingText');
        const messageContainer = document.getElementById('messageContainer');
        const messageText = document.getElementById('messageText');
        
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                console.log('Formulario enviado con JavaScript vanilla (respaldo)');
            
                // Mostrar loading
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                loadingText.style.display = 'flex';
                
                try {
                    const formData = new FormData(form);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    formData.append('_token', csrfToken);
                    
                    // Get the route URL from a global variable that will be set in the Blade template
                    const contactUrl = window.contactRoute || '/contacto';
                    
                    const response = await fetch(contactUrl, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    });
                    
                    const data = await response.json();
                    console.log('Respuesta recibida:', data);
                    
                    if (response.ok && data.success) {
                        // Mostrar mensaje de éxito
                        messageText.textContent = data.message || '¡Mensaje enviado correctamente! Te contactaremos pronto.';
                        messageContainer.className = 'px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm sm:text-base border bg-green-100 border-green-400 text-green-700';
                        messageContainer.style.display = 'block';
                        
                        // Limpiar formulario
                        form.reset();
                        
                        // Scroll al mensaje
                        messageContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        
                    } else {
                        // Mostrar mensaje de error
                        messageText.textContent = data.message || 'Hubo un error al enviar el mensaje.';
                        messageContainer.className = 'px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm sm:text-base border bg-red-100 border-red-400 text-red-700';
                        messageContainer.style.display = 'block';
                    }
                    
                } catch (error) {
                    console.error('Error:', error);
                    messageText.textContent = 'Error de conexión. Por favor, inténtalo de nuevo.';
                    messageContainer.className = 'px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm sm:text-base border bg-red-100 border-red-400 text-red-700';
                    messageContainer.style.display = 'block';
                } finally {
                    // Restaurar botón
                    submitBtn.disabled = false;
                    submitText.style.display = 'inline';
                    loadingText.style.display = 'none';
                }
            });
        }
    }, 100); // Delay para que Alpine.js se inicialice
});

// Smooth scroll para los enlaces del menú
document.addEventListener('DOMContentLoaded', function() {
    // Agregar smooth scroll a todos los enlaces de anclaje
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Si es solo "#", no hacer nada
            if (href === '#') {
                return;
            }
            
            e.preventDefault();
            
            const targetId = href.substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Cerrar menú móvil si está abierto
                const mobileMenu = document.getElementById('mobileMenu');
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });
});
