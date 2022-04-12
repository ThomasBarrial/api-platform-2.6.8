export class User {
  public "@id"?: string;

  constructor(
    _id?: string,
    public name?: string,
    public email?: string,
    public books?: string[]
  ) {
    this["@id"] = _id;
  }
}
