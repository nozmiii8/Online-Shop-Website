document.addEventListener('DOMContentLoaded', function() {
    const buyBtns = document.querySelectorAll('.buy-btn');
    const buyPopup = document.getElementById('buy-popup');
    const qrisPopup = document.getElementById('qris-popup');
    const successPopup = document.getElementById('success-popup');
    const confirmYes = document.getElementById('confirm-yes');
    const confirmNo = document.getElementById('confirm-no');
    const downloadBtn = document.getElementById('download-btn');
    const timerEl = document.getElementById('timer');
    let currentProductId;

    buyBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            currentProductId = this.dataset.id;
            buyPopup.classList.add('show');
        });
    });

    document.querySelector('.close').addEventListener('click', () => buyPopup.classList.remove('show'));
    confirmNo.addEventListener('click', () => buyPopup.classList.remove('show'));

    confirmYes.addEventListener('click', function() {
        buyPopup.classList.remove('show');
        qrisPopup.classList.add('show');
        let timeLeft = 10;
        timerEl.textContent = timeLeft;
        const timer = setInterval(() => {
            timeLeft--;
            timerEl.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(timer);
                qrisPopup.classList.remove('show');
                successPopup.classList.add('show');
            }
        }, 1000);
    });

    downloadBtn.addEventListener('click', function() {
        window.location.href = 'download.php?id=' + currentProductId;
        successPopup.classList.remove('show');
    });

    window.addEventListener('click', function(event) {
        if (event.target == buyPopup) buyPopup.classList.remove('show');
        if (event.target == qrisPopup) qrisPopup.classList.remove('show');
        if (event.target == successPopup) successPopup.classList.remove('show');
    });

    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const products = document.querySelectorAll('.product');
            products.forEach(product => {
                const name = product.querySelector('h3').textContent.toLowerCase();
                const description = product.querySelector('p').textContent.toLowerCase();
                if (name.includes(query) || description.includes(query)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    }
});
