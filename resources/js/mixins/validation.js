export default {
    errors: {},
    touched: {},

    pushError(field, errorMessage) {
        if (Array.isArray(this.errors[field])) {
            this.errors[field].push(errorMessage);
        } else {
            this.errors[field] = [errorMessage];
        }
    },

    hasErrors(field) {
        if (field && this.errors[field] && Array.isArray(this.errors[field])) {
            if (this.errors[field].length) {
                return true;
            }
        } else if (!field) {
            for (let field in this.errors) {
                if (this.errors[field].length) {
                    return true;
                }
            }
        }

        return false;
    },

    getErrors(field) {
        if (field && this.errors[field] && Array.isArray(this.errors[field])) {
            if (this.errors[field].length) {
                return this.errors[field][0];
            }
        } else if (!field) {
            const errors = [];
            for (let field in this.errors) {
                if (this.errors[field].length) {
                    errors.push(this.errors[field][0]);
                }
            }

            return errors.join("\n");
        }

        return "";
    },

    isDirty(field) {
        if (field && this.form[field]) {
            return true;
        } else if (!field) {
            for (let field in this.form) {
                if (this.form[field]) {
                    return true;
                }
            }
        }

        return false;
    },

    isTouched(field) {
        if (field && this.touched[field]) {
            return true;
        } else if (!field) {
            for (let field in this.form) {
                if (this.touched[field]) {
                    return true;
                }
            }
        }

        return false;
    },

    initValidation() {
        for (let field in this.form) {
            this.validate(field);
        }
    },

    handleValidation(event) {
        if (!event.target.name) {
            return false;
        }

        if (event.type === "input") {
            this.errors[event.target.name] = [];
        }

        if (event.type === "focusout") {
            this.touched[event.target.name] = true;
        }

        this.validate(event.target.name);
    },
};
