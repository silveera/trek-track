const toggleSwitch = document.querySelector('#toggle-switch-input');

// Helper function to read a cookie value
function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith(`${name}=`)) {
            return cookie.substring(`${name}=`.length, cookie.length);
        }
    }
    return null;
}

// Read the theme preference from the cookie, if it exists
const theme = getCookie('theme');
if (theme) {
    document.documentElement.setAttribute('data-theme', theme);
    toggleSwitch.checked = (theme === 'dark');
    if (theme === 'dark') {
        darkMode();
    } else {
        lightMode();
    }
} else {
    document.documentElement.setAttribute('data-theme', 'light');
}

toggleSwitch.addEventListener('change', switchTheme);

function switchTheme(event) {
    const theme = event.target.checked ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', theme);

    document.cookie = `theme=${theme}; path=/; max-age=31536000`;

    if (event.target.checked) {
        darkMode();
    } else {
        lightMode();
    }
}

function lightMode() {
    const root = document.documentElement;
  
    root.style.setProperty('--primary-gradient', 'linear-gradient(90deg, #2d9d8a 0%, #95cd98 50%, #2d9d8a 100%)');
    root.style.setProperty('--accent-gradient', 'linear-gradient(135deg, #5268d6 0%, #86adff 50%, #bad4fd 100%)');
    root.style.setProperty('--gradient-btn-1', 'linear-gradient(135deg, rgba(82,104,214,1) 0%, rgba(186,212,253,1) 50%, rgba(176,226,173,1) 51%, rgba(45,157,138,1) 100%)');
    root.style.setProperty('--primary-gradient-1', 'linear-gradient(135deg, #218070 0%, #95cd98 50%, #b0e2ad 100%)');
    root.style.setProperty('--primary-color', '#95cd98');
    root.style.setProperty('--secondary-tint-1', '#E5EEEC');
    root.style.setProperty('--secondary-tint-2', '#B1CBC6');
    root.style.setProperty('--secondary-tint-3', '#7EA8A0');
    root.style.setProperty('--secondary-tint-4', '#4A857A');
    root.style.setProperty('--secondary-color', '#307467');
    root.style.setProperty('--secondary-shade-1', '#24574D');
    root.style.setProperty('--neutral-color', '#212529');
    root.style.setProperty('--invert-neutral-color', '#F2F9F2');
    root.style.setProperty('--invert-neutral-color-shade-1', 'rgb(209, 209, 209)');
    root.style.setProperty('--invert-neutral-color-shade-2', 'rgb(171, 170, 170)');
    root.style.setProperty('--invert-neutral-color-shade-3', 'rgb(148, 148, 148)');
    root.style.setProperty('--invert-neutral-color-shade-4', 'rgb(114, 114, 114)');
    root.style.setProperty('--invert-neutral-color-shade-5', 'rgb(91, 91, 91)');
    root.style.setProperty('--invert-neutral-color-shade-6', 'rgb(68, 68, 68)');
    root.style.setProperty('--invert-neutral-color-shade-7', 'rgb(45, 45, 45)');
    root.style.setProperty('--invert-neutral-color-shade-8', 'rgb(22, 22, 22)');
    root.style.setProperty('--invert-neutral-color-shade-9', 'rgb(0, 0, 0)');
    root.style.setProperty('--primary-tint-1', '#E5F3E5');
    root.style.setProperty('--primary-tint-2', '#D7ECD8');
    root.style.setProperty('--primary-shade-1', '#82B385');
    root.style.setProperty('--primary-shade-2', '#5D805F');
    root.style.setProperty('--accent-color-1', '#5268d6');
    root.style.setProperty('--accent-tint-1', '#86adff');
}  

function darkMode() {
    const root = document.documentElement;

    root.style.setProperty('--primary-gradient', 'linear-gradient(90deg, #0f0b81 0%, #6663c8 50%, #0f0b81 100%)');
    root.style.setProperty('--accent-gradient', 'linear-gradient(135deg, #1c2340 0%, #3f51b5  50%, #3f51b5 100%)');
    root.style.setProperty('--gradient-btn-1', 'linear-gradient(135deg, rgba(28, 35, 64, 1) 0%, rgba(63, 81, 181, 1) 50%, rgba(63, 81, 181, 1) 51%, rgba(28, 35, 64, 1) 100%)');
    root.style.setProperty('--primary-gradient-1', 'linear-gradient(135deg, #20553c 0%, #2b6a4e 50%, #2b6a4e 100%)');
    root.style.setProperty('--primary-color', '#2b6a4e');
    root.style.setProperty('--secondary-tint-1', '#313539');
    root.style.setProperty('--secondary-tint-2', '#4e5254');
    root.style.setProperty('--secondary-tint-3', '#6a6e70');
    root.style.setProperty('--secondary-tint-4', '#86898b');
    root.style.setProperty('--secondary-color', '#c8d0d3');
    root.style.setProperty('--secondary-shade-1', '#d4d4d4');
    root.style.setProperty('--neutral-color', '#FFFFFF');
    root.style.setProperty('--invert-neutral-color', '#212121');
    root.style.setProperty('--invert-neutral-color-shade-1', '#353535');
    root.style.setProperty('--invert-neutral-color-shade-2', '#5c5c5c');
    root.style.setProperty('--invert-neutral-color-shade-3', '#818181');
    root.style.setProperty('--invert-neutral-color-shade-4', '#a6a6a6');
    root.style.setProperty('--invert-neutral-color-shade-5', '#c7c7c7');
    root.style.setProperty('--invert-neutral-color-shade-6', '#e2e2e2');
    root.style.setProperty('--invert-neutral-color-shade-7', '#f1f1f1');
    root.style.setProperty('--invert-neutral-color-shade-8', '#f8f8f8');
    root.style.setProperty('--invert-neutral-color-shade-9', '#ffffff');
    root.style.setProperty('--primary-tint-1', '#131515');
    root.style.setProperty('--primary-tint-2', '#1a1c1d');
    root.style.setProperty('--primary-shade-1', '#5b5b5b');
    root.style.setProperty('--primary-shade-2', '#7c7c7c');
    root.style.setProperty('--accent-color-1', '#3f51b5');
    root.style.setProperty('--accent-tint-1', '#86adff');
}