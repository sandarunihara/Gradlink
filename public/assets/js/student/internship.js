    // Get references to elements
    const applyButtons = document.querySelectorAll('.applyBtn');
    const viewButtons = document.querySelectorAll('.viewBtn');
    const popupBox = document.getElementById('popupBox');
    const popupContent = document.querySelector('.popup-content');
    const okBtn = document.getElementById('okBtn');
    const form = document.querySelector('form');
    const errorId = document.getElementById('errorId');
    const cvUpload = document.getElementById('cvUpload');

    const radios = document.getElementsByName('cvId');


    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            cvUpload.style.display = "none";
            cvUpload.value = "";
            errorId.innerHTML = "";
            errorId.style.display = "none";
        });
    });
    // Show popup when any "Apply" button is clicked
    applyButtons.forEach(button => {
        button.addEventListener('click', () => {
            popupBox.classList.remove('hidden');
            const advertisementId = button.getAttribute('data-advertisement-id');
            form.action = 'http://localhost/Gradlink/public' + '/Student/StudentAd/advertisement/?advertisementId=' + encodeURIComponent(advertisementId);
        });
    });
    // show advertisement when view button is clicked
    viewButtons.forEach(button => {
        button.addEventListener('click', () => {
            const advertisementId = button.getAttribute('data-advertisement-id');
            const url = 'http://localhost/Gradlink/public' + '/Student/StudentAd/viewAdvertisement/' + '?advertisementId=' + encodeURIComponent(advertisementId);
            //console.log(url);
            
            window.location.href = url;
        });
    });

    // Handle file upload when "OK" button is clicked
    okBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if(cvUpload.value){
            if(validateFile(cvUpload)){
                form.submit();
            }
        }else{
            form.submit();
        }

    });
    // Hide popup when clicking outside the content box
    popupBox.addEventListener('click', (event) => {
        if (!popupContent.contains(event.target)) {
            cvUpload.style.display = "block";
            cvUpload.value = "";
            errorId.innerHTML = "";
            popupBox.classList.add('hidden');
            radios.forEach(radio => radio.checked = false);
        }
    });
    function validateFile(input){
        const file = input.files[0];
        const validMimeType = "application/pdf";
        const validExtension = ".pdf";
        const validSize = 5000000; // 5MB in bytes
        let isValid = true;

        if(file === undefined){
            errorId.innerHTML = "Please select a file.";
            errorId.style.display = "block";
            input.classList.add("invalid");
            return false;
        }else if(file.size > validSize){
            errorId.innerHTML = "File size exceeds 1MB.";
            errorId.style.display = "block";
            input.classList.add("invalid");
            return false;
        }else{
            errorId.innerHTML = "";
            errorId.style.display = "none";
            input.classList.remove("invalid");
        }
        // Check MIME type
        if (file.type !== validMimeType) {
            isValid = false;
        }

        // Check file extension
        const fileName = file.name.toLowerCase();
        if (!fileName.endsWith(validExtension)) {
            isValid = false;
        }

        if (!isValid) {
            errorId.innerHTML = "Invalid file type. Only PDF is allowed.";
            errorId.style.display = "block";
            input.classList.add("invalid");
            return false;
        } else {
            radios.forEach(radio => radio.checked = false);
            errorId.innerHTML = "";
            errorId.style.display = "none";
            input.classList.remove("invalid");
            return true;
        }
    }

    function searchCompany(value) {
        const searchTerm = value.toLowerCase().trim();
        const jobCards = document.querySelectorAll(".job-card");
    
        if (searchTerm === "") {
            // If input is empty, show all job cards
            jobCards.forEach(card => {
                card.style.display = "block";
            });
            return;
        }
    
        let found = false;
    
        jobCards.forEach(card => {
            const companyName = card.querySelector(".job-details p").textContent.trim().toLowerCase();
            if (companyName.includes(searchTerm)) {
                card.style.display = "block";
                found = true;
            } else {
                card.style.display = "none";
            }
        });
    
        if (!found) {
            return;
        }
    }
    function searchByPosition() {
        const jobCards = document.querySelectorAll(".job-card");
        const select = document.getElementById("positionSelect");
        const selectedPosition = select.value.toLowerCase();

        if(selectedPosition == "all"){
            jobCards.forEach(card => {
            card.style.display = "block";
            });
            return;
        }
        let found = false;
    
        jobCards.forEach(card => {
            const companyName = card.querySelector(".job-details h3").textContent.trim().toLowerCase();
            if (companyName === selectedPosition) {
                card.style.display = "block";
                found = true;
            } else {
                card.style.display = "none";
            }
        });
    }
    
    