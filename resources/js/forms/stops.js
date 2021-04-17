import validator from "validator";
import helper from "../mixins/helper";
import notification from "../mixins/notification";
import validation from "../mixins/validation";

export default (trip) => ({
    ...validation,
    ...notification,
    ...helper,

    init() {
        $(".stations-data-ajax").select2({
            ajax: {
                url: API.station.index,
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        draw: Math.random() * 100,
                        columns: [{ data: "id" }, { data: "name" }],
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
            placeholder: "Search for a station",
            minimumInputLength: 1,
            templateResult: formatStation,
            templateSelection: formatStationSelection,
        });

        function formatStation(station) {
            if (station.loading) {
                return station.text;
            }

            var $container = $(
                "<div class='select2-result-station clearfix'>" +
                    "<div class='select2-result-station__meta'>" +
                    "<div class='select2-result-station__title'></div>" +
                    "<div class='select2-result-station__description'></div>" +
                    "</div>" +
                    "</div>"
            );

            $container
                .find(".select2-result-station__title")
                .text(station.name);
            $container
                .find(".select2-result-station__description")
                .text(station.notes);

            return $container;
        }

        function formatStationSelection(station) {
            return station.name || station.text;
        }

        this.initValidation();
    },

    title: trip ? `${trip.name}'s stops` : "",

    form: {
        id: trip ? trip.id : "",
        stations: trip ? trip.stations : [],
    },

    validate(field) {},

    async addStop() {
        if (!this.$refs.selectedStop.value.trim()) {
            this.error("Stop is required.");
            return false;
        } else if (!validator.isNumeric(this.$refs.selectedStop.value)) {
            this.error("Selected stop is invalid.");
            return false;
        }

        if (!this.$refs.stopOrder.value.trim()) {
            this.error("Stop order is required.");
            return false;
        } else if (!validator.isNumeric(this.$refs.stopOrder.value)) {
            this.error("Selected stop order is invalid.");
            return false;
        }

        try {
            let resp = await axios.post(
                API.trip.addStop.replace(/ID/, this.form.id),
                {
                    station_id: this.$refs.selectedStop.value,
                    stop_order: this.$refs.stopOrder.value,
                }
            );

            if (resp.data.success) {
                this.success("Stop added successfully");
                $("#addStopModal").modal("hide");
                this.form.stations = resp.data.data;
            } else {
                this.error(resp.data.msg);
            }
        } catch (error) {
            this.catch(error);
        }
    },
    async removeStop(station_id) {
        if (!confirm("Do you confirm removing this stop?")) {
            return false;
        }

        try {
            let resp = await axios.post(
                API.trip.removeStop.replace(/ID/, this.form.id),
                {
                    station_id,
                }
            );

            if (resp.data.success) {
                this.success("Stop removed successfully");
                this.form.stations = resp.data.data;
            } else {
                this.error(resp.data.msg);
            }
        } catch (error) {
            this.catch(error);
        }
    },
});
