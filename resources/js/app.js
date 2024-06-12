import './bootstrap';
document.getElementById('documentation-screenshot').addEventListener('error', function() {
    document.getElementById('screenshot-container').classList.add('!hidden');
    document.getElementById('docs-card').classList.add('!row-span-1');
    document.getElementById('docs-card-content').classList.add('!flex-row');
    document.getElementById('background').classList.add('!hidden');
});
