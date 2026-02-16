document.addEventListener('DOMContentLoaded',function(){

    const contactForm = document.getElementById('contactForm');
    if(!contactForm) return;

    contactForm.setAttribute('novalidate','novalidate');

    contactForm.addEventListener('submit',function(e){
        e.preventDefault();

        let isValid = true;
        const formGroups = contactForm.querySelectorAll(".form-group");

        if(formGroups){
            formGroups.forEach(group=>{
                const input = group.querySelector('.form-control');
                const error = group.querySelector('.input-error');

                error.innerHTML = '';
                if(input && error){
                    if(input.classList.contains('required') && input.value == ''){
                        isValid = false;
                        error.innerHTML = 'Please Fill This Field';
                    }
                }
            })
        }


        if(isValid){
            contactForm.submit();
        }

    })
})