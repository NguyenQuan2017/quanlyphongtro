import moment from "moment";

export default function helpers () {
    const formatDate = (date,format = 'DD/MM/YYYY') => {
        return moment(date).format(format);
    }

    return {
        formatDate
    };
}
