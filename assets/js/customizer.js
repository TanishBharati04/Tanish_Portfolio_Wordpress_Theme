wp.customize('tanish_layout_type', function(value) {
    value.bind(function(newval) {
        document.body.className = newval + '-layout';
    });
});
