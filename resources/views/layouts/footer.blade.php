<!-- Your page content -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SortableJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<script>
    // Enable drag and drop using SortableJS
    ['todo', 'inprogress', 'done'].forEach(id => {
        Sortable.create(document.getElementById(id), {
            group: 'shared',
            animation: 150
        });
    });
</script>

</body>

</html>

