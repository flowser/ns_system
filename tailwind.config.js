/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
      darkMode: 'class',
      theme: {
        extend: {
            colors:{
                green101:      '#00ff1f',
                purple101:      '#9a009a',
                transparent101: '#baa8ce00',
                deepred101:     '#ff0000;',
                red101:         '#da16167a;',
                yellow101:      '#efff00',
                gold101:        '#ffd700',
                orange101:      '#fd7e1480',
                blue101:        '#bf00ff21',
            },
        },
      },
      plugins: [
      ],
}
