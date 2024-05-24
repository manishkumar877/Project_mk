</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlIW2Y3YRm+yKJwSAwy4XNR7f2w7/z9j7sKeEKOtu6+s5tZT4IuJ9g9g8p5" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach((dropdownToggle) => {
            dropdownToggle.addEventListener('click', (e) => {
                let element = e.target;
                while (element && !element.classList.contains('nav-item')) {
                    element = element.parentElement;
                }
                const dropdownMenu = element.querySelector('.dropdown-menu');
                const isExpanded = dropdownMenu.classList.contains('show');
                document.querySelectorAll('.dropdown-menu.show').forEach((menu) => {
                    menu.classList.remove('show');
                });
                if (!isExpanded) {
                    dropdownMenu.classList.add('show');
                }
            });
        });
        document.addEventListener('click', (e) => {
            if (!e.target.matches('.dropdown-toggle')) {
                document.querySelectorAll('.dropdown-menu.show').forEach((menu) => {
                    menu.classList.remove('show');
                });
            }
        });
    });
</script>
</body>
</html>
