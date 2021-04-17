export default {
    success(message) {
        $.notify(message, "success", { autoHideDelay: 3000 });
    },
    error(message) {
        $.notify(message, "error", { autoHideDelay: 3000 });
    },
    warning(message) {
        $.notify(message, "warn", { autoHideDelay: 3000 });
    },
    info(message) {
        $.notify(message, "info", { autoHideDelay: 3000 });
    },
    catch(error) {
        let errors = [];
        if (error.response && error.response.status === 422) {
            for (const er in error.response.data.errors) {
                if (
                    Object.hasOwnProperty.call(error.response.data.errors, er)
                ) {
                    const erArr = error.response.data.errors[er];
                    errors.push(erArr.join("<br>"));
                }
            }
        } else {
            errors.push(error.message);
        }

        this.error(errors.join("<br>"));
    },
};
