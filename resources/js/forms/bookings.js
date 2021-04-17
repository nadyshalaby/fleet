import validator from "validator";
import helper from "../mixins/helper";
import notification from "../mixins/notification";
import validation from "../mixins/validation";

export default (trip) => ({
    ...validation,
    ...notification,
    ...helper,

    init() {
        $(".users-data-ajax").select2({
            ajax: {
                url: API.user.index,
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        draw: Math.random() * 100,
                        columns: [
                            { data: "id" },
                            { data: "name" },
                            { data: "email" },
                        ],
                        order: [{ column: 0, dir: "desc" }],
                        search: { value: params.term }, // search term
                        start: 0,
                        length: 10,
                        _: Date.now(),
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.data,
                        pagination: {
                            more: params.page * 30 < data.recordsTotal,
                        },
                    };
                },
                cache: true,
            },
            placeholder: "Search for a user",
            minimumInputLength: 1,
            templateResult: formatStation,
            templateSelection: formatStationSelection,
        });

        function formatStation(user) {
            if (user.loading) {
                return user.text;
            }

            var $container = $(
                "<div class='select2-result-user clearfix'>" +
                    "<div class='select2-result-user__meta'>" +
                    "<div class='select2-result-user__title'></div>" +
                    "<div class='select2-result-user__description'></div>" +
                    "</div>" +
                    "</div>"
            );

            $container.find(".select2-result-user__title").text(user.name);
            $container
                .find(".select2-result-user__description")
                .text(user.email);

            return $container;
        }

        function formatStationSelection(user) {
            return user.name || user.text;
        }

        this.$watch("pickup_station_id", (id) => {
            if (!id) {
                this.form.arrival_stations = [];
            } else {
                this.form.arrival_stations = this.form.stations.slice(
                    this.form.stations.findIndex((s) => s.id == id) + 1
                );
            }
        });
    },

    title: trip ? `${trip.name}'s bookings` : "",

    form: {
        id: trip ? trip.id : "",
        users: trip ? trip.users : [],
        stations: trip ? trip.stations : [],
        arrival_stations: [],
        pickup_station_id: "",
        arrival_station_id: "",
        seat_number: "",
    },

    validate(field) {},

    async addBooking() {
        if (!this.$refs.selectedBooking.value.trim()) {
            this.error("User is required.");
            return false;
        } else if (!validator.isNumeric(this.$refs.selectedBooking.value)) {
            this.error("Selected user is invalid.");
            return false;
        }

        if (!this.form.pickup_station_id.trim()) {
            this.error("Pickup station is required.");
            return false;
        } else if (!validator.isNumeric(this.form.pickup_station_id)) {
            this.error("Selected pickup station is invalid.");
            return false;
        }

        if (!this.form.arrival_station_id.trim()) {
            this.error("Arrival station is required.");
            return false;
        } else if (!validator.isNumeric(this.form.arrival_station_id)) {
            this.error("Selected arrival station is invalid.");
            return false;
        }

        if (!this.form.seat_number.trim()) {
            this.error("Seat number is required.");
            return false;
        } else if (!validator.isNumeric(this.form.seat_number)) {
            this.error("Selected seat number is invalid.");
            return false;
        }

        try {
            let resp = await axios.post(
                API.trip.addBooking.replace(/ID/, this.form.id),
                {
                    user_id: this.$refs.selectedBooking.value,
                    pickup_station_id: this.form.pickup_station_id,
                    arrival_station_id: this.form.arrival_station_id,
                    seat_number: this.form.seat_number,
                }
            );

            if (resp.data.success) {
                if (resp.data.data.checked.can_book_a_seat) {
                    this.success(
                        `Booking added successfully. (${
                            this.form.stations.find(
                                (s) => s.id == this.form.pickup_station_id
                            ).name
                        } -> ${
                            this.form.stations.find(
                                (s) => s.id == this.form.arrival_station_id
                            ).name
                        }) line has (Available Seats: ${
                            resp.data.data.checked.available_seats - 1
                        } | Booked Seats: ${
                            resp.data.data.checked.booked_seats + 1
                        } | Available Numbers: [${resp.data.data.checked.available_seats_numbers.join(
                            ", "
                        )}] | Booked Numbers: [${resp.data.data.checked.booked_seats_numbers.join(
                            ", "
                        )}])`
                    );
                    $("#addBookingModal").modal("hide");
                    this.form.users = resp.data.data.users;
                } else {
                    this.warning(
                        `There's no available seats in this line (${
                            this.form.stations.find(
                                (s) => s.id == this.form.pickup_station_id
                            ).name
                        } -> ${
                            this.form.stations.find(
                                (s) => s.id == this.form.arrival_station_id
                            ).name
                        } | Available Numbers: [${resp.data.data.checked.available_seats_numbers.join(
                            ", "
                        )}] | Booked Numbers: [${resp.data.data.checked.booked_seats_numbers.join(
                            ", "
                        )}]).`
                    );
                }
            } else {
                this.error(resp.data.msg);
            }
        } catch (error) {
            this.catch(error);
        }
    },
    async removeBooking(user_id) {
        if (!confirm("Do you confirm removing this booking?")) {
            return false;
        }

        try {
            let resp = await axios.post(
                API.trip.removeBooking.replace(/ID/, this.form.id),
                {
                    user_id,
                }
            );

            if (resp.data.success) {
                this.success("Booking removed successfully");
                this.form.users = resp.data.data;
            } else {
                this.error(resp.data.msg);
            }
        } catch (error) {
            this.catch(error);
        }
    },
});
