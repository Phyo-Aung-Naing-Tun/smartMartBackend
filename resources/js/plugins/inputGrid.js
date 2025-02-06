export default {
    install: (app, options) => {
        //for input style grid
        let isMinimize = false;

        function getInputLayout(minimize) {
            isMinimize = minimize;
            return minimize ? "space-y-2" : "grid grid-cols-12";
        }

        function getLabelPosition(grid) {
            return isMinimize ? "" : `col-span-${grid}`;
        }

        function getInputPosition(grid) {
            return isMinimize ? "" : `col-span-${12 - grid}`;
        }
        app.config.globalProperties.$getInputLayout = getInputLayout;
        app.config.globalProperties.$getLabelPosition = getLabelPosition;
        app.config.globalProperties.$getInputPosition = getInputPosition;
    },
};
