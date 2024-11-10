export default {
    install: (app) => {
        let timeout;
        function useDebounce(method, timer) {
            clearTimeout(timeout);
            timeout = setTimeout(method, timer);
        }
        app.provide("useDebounce", useDebounce);
    },
};
