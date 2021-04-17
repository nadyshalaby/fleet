import validator from "validator";
import notification from "../mixins/notification";
import validation from "../mixins/validation";

export default (user) => ({
    ...validation,
    ...notification,

    title: "User" + (user ? ` "${user.name}"` : " Form"),
    form: {
        id: user ? user.id : "",
        name: user ? user.name : "",
        email: user ? user.email : "",
        role: user ? user.role : "",
        password: "",
        password_confirmation: "",
    },

    validate(field) {
        switch (field) {
            case "name":
                if (!this.form.name.trim()) {
                    this.pushError("name", "Name is required.");
                }

                break;
            case "email":
                if (!this.form.email.trim()) {
                    this.pushError("email", "Email address is required.");
                } else if (!validator.isEmail(this.form.email.trim())) {
                    this.pushError("email", "Email address is invalid.");
                }

                break;
            case "role":
                if (!this.form.role.trim()) {
                    this.pushError("role", "Role is required.");
                } else if (
                    !validator.matches(this.form.role.trim(), /(admin|normal)/)
                ) {
                    this.pushError("role", "Role is invalid.");
                }

                break;
            case "password":
            case "password_confirmation":
                if (!this.form.id && !this.form.password.trim()) {
                    this.pushError("password", "Password is required.");
                }

                if (
                    !validator.isEmpty(this.form.password) &&
                    !validator.isStrongPassword(this.form.password)
                ) {
                    this.pushError(
                        "password",
                        "Your password is weak. <br> Strong password should be at least 8 in size and has a mix of letters (upper and lower case), numbers, and symbols."
                    );
                }

                if (
                    !validator.isEmpty(this.form.password) &&
                    !validator.equals(
                        this.form.password,
                        this.form.password_confirmation
                    )
                ) {
                    this.pushError(
                        "password_confirmation",
                        "Password and password confirmation not matched."
                    );
                }

                break;
        }
    },

    async submit() {
        if (!this.hasErrors()) {
            try {
                let resp;

                if (!this.form.id) {
                    resp = await axios.post(API.user.store, this.form);
                } else {
                    resp = await axios.put(
                        API.user.update.replace(/ID/, this.form.id),
                        this.form
                    );
                }

                if (resp.data.success) {
                    this.success("Data saved successfully");
                    setTimeout(() => {
                        location.href = API.user.index;
                    }, 1500);
                } else {
                    this.error(resp.data.msg);
                }
            } catch (error) {
                this.catch(error);
            }
        }
    },
});
