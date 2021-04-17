import validator from "validator";
import notification from "../mixins/notification";
import validation from "../mixins/validation";

export default (trip) => ({
    ...validation,
    ...notification,

    title: "Trip" + (trip ? ` "${trip.name}"` : " Form"),
    form: {
        id: trip ? trip.id : "",
        name: trip ? trip.name : "",
    },

    validate(field) {
        switch (field) {
            case "name":
                if (!this.form.name.trim()) {
                    this.pushError("name", "Name is required.");
                }

                break;
        }
    },

    async submit() {
        if (!this.hasErrors()) {
            try {
                let resp;

                if (!this.form.id) {
                    resp = await axios.post(API.trip.store, this.form);
                } else {
                    resp = await axios.put(
                        API.trip.update.replace(/ID/, this.form.id),
                        this.form
                    );
                }

                if (resp.data.success) {
                    this.success("Data saved successfully");
                    setTimeout(() => {
                        location.href = API.trip.index;
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
