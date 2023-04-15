const simple_filter = document.getElementById("simple_filter");
const advanced_filter = document.getElementById("advanced_filter");

advanced_filter.style.display = 'none';

document.getElementById("setAdvanced").addEventListener('click', function() {
    simple_filter.style.display = 'none';
    advanced_filter.style.display = 'block';
});

document.getElementById("setSimple").addEventListener('click', function() {
    advanced_filter.style.display = 'none';
    simple_filter.style.display = 'block';
});