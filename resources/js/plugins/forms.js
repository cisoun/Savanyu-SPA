function isUndefined (value) {
  return value === undefined
}

function isObject (value) {
  return value === Object(value)
}

function isArray (value) {
  return Array.isArray(value)
}

function isFile (value) {
  return value instanceof File
}

function isDate (value) {
  return value instanceof Date
}

function objectToFormData (object) {
  const formData = new FormData();
  Object.keys(object).forEach((key) => {
    let item = object[key];
    if (isArray(item)) {
      const k = key + '[]';
      item.forEach(i => { formData.append(k, i); })
    } else {
      formData.append(key, item);
    }
  });
  return formData;
}

function showErrorsForForm(errors, form) {
  form.errors.set(form.extractErrors(errors.response))
}

export { objectToFormData, showErrorsForForm };
