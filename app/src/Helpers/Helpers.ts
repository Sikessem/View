export function isset(value: any): boolean
{
  return value !== undefined && value !== null;
}

export function construct<T>(target: Function, args: {[key: string|number]: any}): T
{
  if (typeof target !== 'function' && typeof target !== 'object') {
    return Reflect.construct<any[], T>(target, []);
  }

  const matches = /constructor\((.*)\)/g.exec(target.toString());
  const params = (matches ? (matches[1] ?? '') : '').split(', ');

  const values = parseValues(params, args);
  return Reflect.construct(target, values);
}

function parseValues(params: Array<string>, args: {[key: string|number]: any}): Array<any> {
  const values: any[] = [];

  let key = 0;

  params.forEach(param => {
    values[key] = args[param] ?? args[key] ?? null;
    ++key;
  })

  return values;
}
