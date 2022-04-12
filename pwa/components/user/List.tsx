import { FunctionComponent } from "react";
import Link from "next/link";
import ReferenceLinks from "../../components/common/ReferenceLinks";
import { User } from "../../types/User";

interface Props {
  users: User[];
}

export const List: FunctionComponent<Props> = ({ users }) => (
  <div>
    <h1>User List</h1>
    <Link href="/users/create">
      <a className="btn btn-primary">Create</a>
    </Link>
    <table className="table table-responsive table-striped table-hover">
      <thead>
        <tr>
          <th>id</th>
          <th>name</th>
          <th>email</th>
          <th>books</th>
          <th />
        </tr>
      </thead>
      <tbody>
        {users &&
          users.length !== 0 &&
          users.map((user) => (
            <tr key={user["@id"]}>
              <th scope="row">
                <ReferenceLinks items={user["@id"]} type="user" />
              </th>
              <td>{user["name"]}</td>
              <td>{user["email"]}</td>
              <td>
                <ReferenceLinks items={user["books"]} type="Book" />
              </td>
              <td>
                <ReferenceLinks
                  items={user["@id"]}
                  type="user"
                  useIcon={true}
                />
              </td>
              <td>
                <Link href={`${user["@id"]}/edit`}>
                  <a>
                    <i className="bi bi-pen" aria-hidden="true" />
                    <span className="sr-only">Edit</span>
                  </a>
                </Link>
              </td>
            </tr>
          ))}
      </tbody>
    </table>
  </div>
);
