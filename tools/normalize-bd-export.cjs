const fs = require('fs');
const path = require('path');

const files = ['public/data/divisions.json', 'public/data/districts.json', 'public/data/upazilas.json'];

function extractTableData(raw) {
    // phpMyAdmin export format: array of objects
    if (Array.isArray(raw)) {
        const tableObj = raw.find((x) => x && x.type === 'table' && x.data);
        if (tableObj) {
            // data may be array OR object { divisions: [...] }
            if (Array.isArray(tableObj.data)) return tableObj.data;
            if (tableObj.data && typeof tableObj.data === 'object') {
                const firstKey = Object.keys(tableObj.data)[0];
                return tableObj.data[firstKey] || tableObj.data;
            }
        }
    }
    return raw;
}

files.forEach((file) => {
    const full = path.join(__dirname, '..', file);
    const raw = JSON.parse(fs.readFileSync(full, 'utf8'));
    const data = extractTableData(raw);

    fs.writeFileSync(full, JSON.stringify(data, null, 2), 'utf8');
    console.log(`✅ normalized: ${file} (${Array.isArray(data) ? data.length : 'not array'})`);
});
