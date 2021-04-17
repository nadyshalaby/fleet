import validator from "validator";
import notification from "../mixins/notification";
import validation from "../mixins/validation";

export default (station) => ({
    ...validation,
    ...notification,

    title: "Station" + (station ? ` "${station.name}"` : " Form"),
    form: {
        id: station ? station.id : "",
        name: station ? station.name : "",
        notes: station ? station.notes : "",
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
                    resp = await axios.post(API.station.store, this.form);
                } else {
                    resp = await axios.put(
                        API.station.update.replace(/ID/, this.form.id),
                        this.form
                    );
                }

                if (resp.data.success) {
                    this.success("Data saved successfully");
                    setTimeout(() => {
                        location.href = API.station.index;
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
