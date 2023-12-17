const isDarkMode = localStorage.getItem('darkMode') === 'enabled';

        if (isDarkMode) {
            document.body.classList.add('dark');
            document.querySelector('.form-container').classList.add('dark');
        }

        function toggleDarkMode() {
            const body = document.body;
            const formContainer = document.querySelector('.form-container');

            body.classList.toggle('dark');
            formContainer.classList.toggle('dark');

            const darkModeEnabled = body.classList.contains('dark');
            localStorage.setItem('darkMode', darkModeEnabled ? 'enabled' : 'disabled');
        }