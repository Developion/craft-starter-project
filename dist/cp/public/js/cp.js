function findBlockInstance($el) {
    const data = $el.data();
    for (const k in data) {
        const v = data[k];
        if (v && typeof v.collapse === 'function') return v;
    }
    return null;
}

document.addEventListener('click', (e) => {
    if (!e.target.closest('#collapse-all')) return;

    $('[data-id].matrixblock, [data-id].ni_block').each(function () {
        const $el = $(this);
        const inst = findBlockInstance($el);
        if (inst) {
            inst.collapse();
        } else {

            $el.addClass('collapsed').find('> .fields').hide();
            $el.css('height', '');
        }
    });
});

document.addEventListener('click', (e) => {
    if (!e.target.closest('#expand-all')) return;

    $('[data-id].matrixblock, [data-id].ni_block').each(function () {
        const $el = $(this);
        const inst = findBlockInstance($el);
        if (inst && typeof inst.expand === 'function') {
            inst.expand();
        } else {
            $el.removeClass('collapsed').children('.fields').show();
            $el.css('height', '');
        }
    });
});