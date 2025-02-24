document.addEventListener('DOMContentLoaded', () => {
    console.log('VPN Providers theme initialized');

    // Example: Add click handlers to provider rows
    const providerRows = document.querySelectorAll('.providers-table tbody tr');
    providerRows.forEach(row => {
        row.addEventListener('click', (e) => {
            if (e.target.tagName !== 'A') {
                const link = row.querySelector('a');
                if (link) window.location.href = link.href;
            }
        });
    });
});