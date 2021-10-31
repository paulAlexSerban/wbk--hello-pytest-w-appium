// the debounce function receives our functions as a parameter
export const debounce = (fn) => {
  let frame;

  return (...params) => {
    if(frame) {
      cancelAnimationFrame(frame);
    }

    frame = requestAnimationFrame(() => {
      fn(...params);
    })
  }
}