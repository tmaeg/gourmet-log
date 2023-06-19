import lang from '/lang/ja.json';

const observer = new MutationObserver((mutationList, observer) => {
    for(const mutation of mutationList) {
        for(const node of mutation.addedNodes) {
            translate(node);
        }
    }
});

observer.observe(document.body, {
    subtree: true,
    childList: true,
});

function translate(node) {
    if(node.nodeName === '#text') {
        if(node.textContent) {
            const text = node.textContent.replace(/\s{2,}/g, ' ').replace(/^ /, '').replace(/ $/, '');
            if(text in lang) {
                node.textContent = lang[text];
            }
        }
    } else if(node instanceof Element && node.dataset.myTranslate !== 'no') {
        for(const child of node.childNodes) {
            translate(child);
        }
        if(node.placeholder) {
            node.placeholder = lang[node.placeholder];
        }
        if(node.label) {
            node.label = lang[node.label];
        }
    }
}
