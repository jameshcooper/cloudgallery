import dayjs from "dayjs";

export default date => {
  return dayjs(date).format("MMMM D, YYYY");
};
