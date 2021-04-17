require("./bootstrap");

import user from "./forms/user";
import station from "./forms/station";
import trip from "./forms/trip";
import stops from "./forms/stops";
import bookings from "./forms/bookings";

window.FORMS = {
    user,
    trip,
    station,
    stops,
    bookings,
};
