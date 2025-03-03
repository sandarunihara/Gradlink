    // Get references to elements
    const applyButtons = document.querySelectorAll('.applyBtn');
    const viewButtons = document.querySelectorAll('.viewBtn');
    const popupBox = document.getElementById('popupBox');
    const popupContent = document.querySelector('.popup-content');
    const okBtn = document.getElementById('okBtn');
    const form = document.querySelector('form');


    // Show popup when any "Apply" button is clicked
    applyButtons.forEach(button => {
        button.addEventListener('click', () => {
            popupBox.classList.remove('hidden');
            const advertisementId = button.getAttribute('data-advertisement-id');
            form.action = form.action + '?advertisementId=' + encodeURIComponent(advertisementId);
        });
    });
    // show advertisement when view button is clicked
    viewButtons.forEach(button => {
        button.addEventListener('click', () => {
            const advertisementId = button.getAttribute('data-advertisement-id');
            const url = '<?=ROOT?>' + '/Student/StudentAd/viewAdvertisement/' + '?advertisementId=' + encodeURIComponent(advertisementId);
            window.location.href = url;
        });
    });
    // Hide popup and handle file upload when "OK" button is clicked
    okBtn.addEventListener('click', () => {
        const cvFile = document.getElementById('cvUpload').files;
        if(cvFile.length !== 0) {
            form.submit();
        }
    });

    // Hide popup when clicking outside the content box
    popupBox.addEventListener('click', (event) => {
        if (!popupContent.contains(event.target)) {
            popupBox.classList.add('hidden');
        }
    });
    document.getElementById("searchIcon").addEventListener("click", function () {
        const searchTerm = document.getElementById("searchInput").value.toLowerCase();
        const jobCards = document.querySelectorAll(".job-card");
        
        let companyNames = [];
        jobCards.forEach(card => {
            const companyName = card.querySelector(".job-details p").textContent.trim();
            companyNames.push(companyName.toLowerCase());
        });
        //console.log(companyNames);
        if(!companyNames.includes(searchTerm)){
            errorToast("Company not found");
        }else{
            jobCards.forEach(card => {
                const companyName = card.querySelector(".job-details p").textContent.trim();
                if(companyName.toLowerCase() === searchTerm){
                    card.style.display = "block";
                }else{
                    card.style.display = "none";
                }
            });
        }
    });