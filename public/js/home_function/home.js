// If you want to use JavaScript for smoother transitions
document.querySelector('.user-profile').addEventListener('mouseenter', function() {
    this.querySelector('.hover-menu').style.display = 'block';
});

document.querySelector('.user-profile').addEventListener('mouseleave', function() {
    this.querySelector('.hover-menu').style.display = 'none';
});
