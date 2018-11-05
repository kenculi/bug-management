function Modal(element, trigger, options) {
    var defaultOptions = {
        backdrop: true,
        keyboard: true,
        show: true
    }

    if (typeof options === 'object')
        this.options = Object.assign(defaultOptions, options);
    else
        this.options = defaultOptions;

    if (this.setTrigger(trigger) === false) return;

    this.modal = $(element);
    this.frame = this.modal.find('iframe');
    this.setEvents();
}

Modal.prototype.setEvents = function() {
    var that = this;

    this.trigger.click(function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        that.modal.modal(that.options);
        that.frame.attr('src', url);
    });

    this.frame[0].onload = function() {
        this.height = this.contentWindow.document.getElementById('wrapper').scrollHeight
    }
}

Modal.prototype.setTrigger = function(element) {
    if (typeof element === 'object')
        this.trigger = element;
    else
        this.trigger = $(element);
    if (!this.trigger.length) return false;

    if (!this.trigger.data('url'))
        throw new Error("Trigger\'s attribute data-url is not set");
}

Modal.prototype.onloadFrame = function(ele) {
    var that = $(ele);
    that.height(that.contents().find("body").height());
}

Modal.adjustIframeHeight = function() {
    var iframe = window.parent.document.querySelector('.modal iframe');
    if (!iframe) return;
    iframe.height = document.getElementById('wrapper').scrollHeight;
}
