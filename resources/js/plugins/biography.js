export function toTable (text) {
  let table = '<table>';

  const lines = text.split('\n');
  lines.forEach((line) => {
    // If empty line, pass...
    if (line.trim() == '') {
      return; // Equals to 'continue' in for loops.
    }

    table += '<tr>';

    const parts = line.split('\t');
    parts.forEach((part) => {
      let attributes = '';

      if (parts.length == 1) {
        attributes = `class="font-weight-bold py-3" colspan="2"`;
      }

      table += `<td ${attributes}>${part}</td>`;
    });

    table += '</tr>';
  });

  table += '</table>';

  return table;
}
