(async function () {
    const response = await fetch('config/acquisitions_data.php');
    const result = await response.json();

    // Update total books
    if (Array.isArray(result.data)) {
        const total = result.data.reduce((sum, val) => sum + val, 0);
        const totalBooksElem = document.getElementById('total-books');
        if (totalBooksElem) totalBooksElem.textContent = total;
    }

    const data = {
        labels: result.labels,
        datasets: [{
            label: 'Books',
            data: result.data,
            borderWidth: 1,
            backgroundColor: ['#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400'],
        }]
    };

    new Chart(
        document.getElementById('acquisitions'),
        {
            type: 'pie',
            data: data,
            options: {
                plugins: {
                    legend: {
                        onHover: handleHover,
                        onLeave: handleLeave
                    }
                }
            }
        }
    );

    // Append '4d' to the colors (alpha channel), except for the hovered index
    function handleHover(evt, item, legend) {
        legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
            colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
        });
        legend.chart.update();
    }

    // Removes the alpha channel from background colors
    function handleLeave(evt, item, legend) {
        legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
            colors[index] = color.length === 9 ? color.slice(0, -2) : color;
        });
        legend.chart.update();
    }
})();
