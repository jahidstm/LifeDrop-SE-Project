const fs = require('fs');
const path = require('path');

const rawDivisions = JSON.parse(fs.readFileSync(path.join(__dirname, '../public/data/divisions.json'), 'utf8'));
const rawDistricts = JSON.parse(fs.readFileSync(path.join(__dirname, '../public/data/districts.json'), 'utf8'));
const rawUpazilas = JSON.parse(fs.readFileSync(path.join(__dirname, '../public/data/upazilas.json'), 'utf8'));

// ✅ phpMyAdmin export হলে actual array থাকে data.divisions / data.districts / data.upazilas
const divisions = rawDivisions.data?.divisions || rawDivisions;
const districts = rawDistricts.data?.districts || rawDistricts;
const upazilas = rawUpazilas.data?.upazilas || rawUpazilas;

const divisionById = Object.fromEntries(divisions.map((d) => [d.id, d]));
const districtById = Object.fromEntries(districts.map((d) => [d.id, d]));

const divisionsMap = {};

divisions.forEach((div) => {
    divisionsMap[div.bn_name || div.name] = {};
});

districts.forEach((dist) => {
    const div = divisionById[dist.division_id];
    if (!div) return;
    const divisionName = div.bn_name || div.name;
    const districtName = dist.bn_name || dist.name;

    if (!divisionsMap[divisionName]) divisionsMap[divisionName] = {};
    divisionsMap[divisionName][districtName] = [];
});

upazilas.forEach((upz) => {
    const dist = districtById[upz.district_id];
    if (!dist) return;
    const div = divisionById[dist.division_id];
    if (!div) return;

    const divisionName = div.bn_name || div.name;
    const districtName = dist.bn_name || dist.name;

    if (!divisionsMap[divisionName]) divisionsMap[divisionName] = {};
    if (!divisionsMap[divisionName][districtName]) divisionsMap[divisionName][districtName] = [];

    divisionsMap[divisionName][districtName].push(upz.bn_name || upz.name);
});

const output = { divisions: divisionsMap };

fs.writeFileSync(path.join(__dirname, '../public/data/bd-locations.json'), JSON.stringify(output, null, 2), 'utf8');

console.log('✅ bd-locations.json তৈরি হয়েছে (full data)');
